<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\ChargeFactory;
use App\Factory\ChargeLineFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChargeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $charge = ChargeFactory::new()->create()->object();

        for ($i = 0; $i < rand(3, 5); ++$i) {
            $chargeLine = ChargeLineFactory::new()->create()->object();

            $charge->addChargeLine($chargeLine);
        }

        $manager->persist($charge);
        $manager->flush();
    }
}
