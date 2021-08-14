<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Json;

/**
 * Получает и сохраняет репозитории юзеров github.
 */
class LoadGithubUsersReposController extends Controller
{
    public function actionIndex()
    {
        $users = Yii::$app->params['githubUsers'];
        $usersRepos = [];
        foreach ($users as $user) {
            $usersRepos = array_merge($usersRepos, static::getUserRepos($user));
        }

        usort($usersRepos, function ($a, $b) {
            if ($a['updated'] < $b['updated'])
                return 1;
            elseif ($a['updated'] > $b['updated'])
                return -1;
            else
                return 0;
        });

        $usersRepos = array_slice($usersRepos, 0, 10);

        Yii::$app->cache->set('usersRepos', $usersRepos);

        return ExitCode::OK;
    }

    public static function getUserRepos($user)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.github.com/users/$user/repos?sort=updated&per_page=10",
            CURLOPT_USERAGENT => 'lexxtor',
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $json = curl_exec($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
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
