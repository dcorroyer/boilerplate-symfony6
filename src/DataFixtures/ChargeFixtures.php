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
        /* @phpstan-ignore-next-line */
        $charge = ChargeFactory::new()->create()->object();

        for ($i = 0; $i < rand(3, 5); ++$i) {
            /* @phpstan-ignore-next-line */
            $chargeLine = ChargeLineFactory::new()->create()->object();

            /* @phpstan-ignore-next-line */
            $charge->addChargeLine($chargeLine);
        }

        $manager->persist($charge);
        $manager->flush();
    }
}
