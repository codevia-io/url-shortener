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
            if (filter_var(
                $_POST['url'],
                \FILTER_VALIDATE_URL
            )) {
                $qb = $em->createQueryBuilder();
                $link = $em->getRepository('Entity\\Link')
                    ->findOneBy(['destination' => $_POST['url']]);

                $id = 0;

                if ($link === null) {
                    $link = new Link();
                    $link->setDestination($_POST['url']);
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
