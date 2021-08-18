<?php

namespace app\commands;

use app\models\GithubUser;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Json;

/**
 * Получает и сохраняет репозитории юзеров github.
 */
class LoadGithubUsersReposController extends Controller
{
    protected static $curl;

    public function actionIndex(): int
    {
        $users = GithubUser::find()->select('name')->column();
        $usersRepos = [];
        foreach ($users as $user) {
            $usersRepos[] = static::getUserRepos($user);
        }
        $usersRepos = array_merge(...$usersRepos);

        usort($usersRepos, function ($a, $b) {
            return $b['updated'] <=> $a['updated'];
        });

        $usersRepos = array_slice($usersRepos, 0, 10);

        Yii::$app->cache->set('usersRepos', $usersRepos);
        Yii::$app->cache->set('usersReposDate', time());

        return ExitCode::OK;
    }

    public static function getUserRepos($user): array
    {
        static::$curl ?? static::$curl = curl_init();

        curl_setopt_array(static::$curl, [
            CURLOPT_URL => "https://api.github.com/users/$user/repos?sort=updated&per_page=10",
            CURLOPT_USERAGENT => 'lexxtor',
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $json = curl_exec(static::$curl);

        if (curl_getinfo(static::$curl, CURLINFO_HTTP_CODE) != 200) {
            return [];
        }

        $repos = Json::decode($json);

        $resultRepos = [];
        foreach ($repos as $repo) {
            $resultRepos[] = [
                'user' => $user,
                'full_name' => $repo['full_name'],
                'url' => $repo['html_url'],
                'updated' => $repo['updated_at'],
            ];
        }

        return $resultRepos;
    }
}
