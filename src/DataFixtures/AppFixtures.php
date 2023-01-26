<?php

namespace App\DataFixtures;

use App\Entity\MenuCategory;
use App\Entity\MenuItem;
use App\Entity\Offer;
use App\Entity\OfferMenuItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sharing = new MenuCategory();
        $sharing->setName("Sharing");
        $manager->persist($sharing);

        $dish1 = new MenuItem();
        $dish1->setName("Charcuterie");
        $dish1->setCategory($sharing);
        $dish1->setDescription("Charcuterie board with selected cured hams and cheeses from our kitchen Served with biscuits, dried fruits and nuts");
        $dish1->setIngredients("");
        $dish1->setRecipe("");
        $dish1->setPrice(49.9);
        $dish1->setActive(true);
        $manager->persist($dish1);
        
        $dish2 = new MenuItem();
        $dish2->setName("Mediterranean garlic bread");
        $dish2->setCategory($sharing);
        $dish2->setDescription("Homemade bottom-fried in wood-burning stove with cheese and house herb butter");
        $dish2->setIngredients("");
        $dish2->setRecipe("");
        $dish2->setPrice(17.9);
        $dish2->setActive(true);
        $manager->persist($dish2);
        
        $dish3 = new MenuItem();
        $dish3->setName("Snack plate");
        $dish3->setCategory($sharing);
        $dish3->setDescription("Chili poppers, chicken nuggets, Buffalo Wings, mozzarella sticks, nachos and potato slices Celery sticks, served with three different dips: sweet & sour, garlic dressing and chipotle");
        $dish3->setIngredients("");
        $dish3->setRecipe("");
        $dish3->setPrice(29.9);
        $dish3->setActive(true);
        $manager->persist($dish3);
        
        $dish4 = new MenuItem();
        $dish4->setName("Nachos with grated cheese");
        $dish4->setCategory($sharing);
        $dish4->setDescription("Nachos with sriracha sauce, cheese, leeks, salsa and garlic dressing");
        $dish4->setIngredients("");
        $dish4->setRecipe("");
        $dish4->setPrice(29.9);
        $dish4->setActive(true);
        $manager->persist($dish4);

        $offer1 = new Offer();
        $offer1->setDateActiveFrom(new \DateTime('2023/1/10'));
        $offer1->setDateActiveTo(new \DateTime('2023/1/31'));
        $offer1->setTimeActiveFrom(new \DateTime('07:00:00'));
        $offer1->setTimeActiveTo(new \DateTime('23:00:00'));
        $offer1->setOfferDiscount(20);
        $manager->persist($offer1);

        $offerMenuItem1 = new OfferMenuItem();
        $offerMenuItem1->setMenuItem($dish1);
        $offerMenuItem1->setOffer($offer1);
        $manager->persist($offerMenuItem1);

        $offerMenuItem2 = new OfferMenuItem();
        $offerMenuItem2->setMenuItem($dish4);
        $offerMenuItem2->setOffer($offer1);
        $manager->persist($offerMenuItem1);

        $manager->flush();
    }
}
