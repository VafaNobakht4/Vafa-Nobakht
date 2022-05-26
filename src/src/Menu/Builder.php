<?php


namespace App\Menu;

use App\Entity\Blog;
use App\Entity\Hotel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

final class Builder
{
    private EntityManagerInterface $entityManager;
    private FactoryInterface $factory;

    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
    }

    public function mainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('home', ['route' => 'home']);
        $menu->addChild('about', ['route' => 'about']);
        $menu->addChild('contact us', ['route' => 'app_contact_new']);
        $menu->addChild('hotels', ['route' => 'app_hotel_index']);
        $hotels = $this->entityManager->getRepository(Hotel::class)->findAll();
        foreach ($hotels as $hotel) {
            $menu['hotels']->addChild($hotel->getName(), ['route' => 'app_hotel_show', 'routeParameters' => ['id' => $hotel->getId()],]);
        }


        return $menu;
    }
}