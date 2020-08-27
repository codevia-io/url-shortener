<?php

namespace API;

use \Entity\Link;

class URL
{
    public function GET($em, $vars)
    {
        $link = $em->find('Entity\\Link', base_convert($vars['id'], 36, 10));

        if ($link !== null) {
            header('Location: ' . $link->getDestination());
            exit;
        }

        // TODO: Add default 404 page
    }


    public function POST($em)
    {
        if (isset($_POST['url'])) {
            $url = $_POST['url'];
            $url = strpos($url, 'http') !== 0 ? "http://$url" : $url;
            
            if (filter_var(
                $url,
                \FILTER_VALIDATE_URL
            )) {
                $qb = $em->createQueryBuilder();
                $link = $em->getRepository('Entity\\Link')
                    ->findOneBy(['destination' => $url]);

                $id = 0;

                if ($link === null) {
                    $link = new Link();
                    $link->setDestination($url);
                    $link->setDate(new \DateTime());
                    $em->persist($link);
                    $em->flush();
                }

                echo json_encode([
                    'url' => base_convert($link->getId(), 10, 36)
                ]);

                return;
            }
        }

        echo json_encode([
            'url' => null
        ]);
    }
}
