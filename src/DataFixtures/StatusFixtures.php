<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Status;
use App\Entity\Role; // Assuming you have a Role entity

class StatusFixtures extends Fixture
{
    public const STATUSES = [
        ['Podáno', 'Článek je nově vytvořený', 'ROLE_EDITOR'],
        ['Vráceno z důvodu tematické nevhodnosti', 'Článek byl vrácen autorovi z důvodu tématické nevhodnosti', 'ROLE_AUTHOR'],
        ['Vráceno', 'Článek byl vrácen bez dalšího komentáře', 'ROLE_AUTHOR'],
        ['Čeká na stanovení recenzentů', 'Probíhá výběr vhodných recenzentů', 'ROLE_EDITOR'],
        ['Recenzní řízení probíhá', 'Recenzní řízení článku je v procesu', 'ROLE_REVIEWER'],
        ['Posudek Review 1 doručen redakci', 'První posudek Review byl doručen redakci', 'ROLE_EDITOR'],
        ['Posudek Review 2 doručen redakci', 'Druhý posudek Review byl doručen redakci', 'ROLE_EDITOR'],
        ['Posudky odeslány autorovi', 'Posudky byly odeslány autorovi k přezkoumání', 'ROLE_AUTHOR'],
        ['Čeká na dodatečné opravy ze strany autora', 'Čeká se na dodatečné opravy od autora', 'ROLE_AUTHOR'],
        ['Čeká na dodatečné vyjádření ze strany recenzenta', 'Čeká se na dodatečné vyjádření od recenzenta', 'ROLE_REVIEWER'],
        ['Čeká na vyjádření šéfredaktora', 'Čeká se na vyjádření šéfredaktora', 'ROLE_CHIEFEDITOR'],
        ['Přijato', 'Článek byl přijat k publikaci', 'ROLE_EDITOR'],
        ['Zamítnuto', 'Článek byl zamítnut', 'ROLE_EDITOR'],
        ['Přijato s výhradami', 'Článek byl přijat s výhradami', 'ROLE_EDITOR']
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::STATUSES as $statusData) {
            $this->newStatus($statusData[0], $statusData[1], $statusData[2], $manager);
        }


    }


    public function newStatus($nazev, $popis, $zodpovednaRole, ObjectManager $manager) {
        $status = new Status();
        $status->setNazev($nazev);
        $status->setPopis($popis);
        $status->setZodpovednaRole($this->getReference($zodpovednaRole)); // Set the related role

        $manager->persist($status);

        $manager->flush();
    }
}
