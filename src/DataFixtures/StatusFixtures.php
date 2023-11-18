<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Status;
use App\Entity\Role; // Assuming you have a Role entity

class StatusFixtures extends Fixture
{
    public const STATUSES = [
        ['Podáno', 'Článek je nově vytvořený', 'ROLE_REDAKTOR'],
        ['Vráceno z důvodu tematické nevhodnosti', 'Článek byl vrácen autorovi z důvodu tématické nevhodnosti', 'ROLE_AUTOR'],
        ['Vráceno', 'Článek byl vrácen bez dalšího komentáře', 'ROLE_AUTOR'],
        ['Čeká na stanovení recenzentů', 'Probíhá výběr vhodných recenzentů', 'ROLE_REDAKTOR'],
        ['Recenzní řízení probíhá', 'Recenzní řízení článku je v procesu', 'ROLE_RECENZENT'],
        ['Posudek recenze 1 doručen redakci', 'První posudek recenze byl doručen redakci', 'ROLE_REDAKTOR'],
        ['Posudek recenze 2 doručen redakci', 'Druhý posudek recenze byl doručen redakci', 'ROLE_REDAKTOR'],
        ['Posudky odeslány autorovi', 'Posudky byly odeslány autorovi k přezkoumání', 'ROLE_AUTOR'],
        ['Čeká na dodatečné opravy ze strany autora', 'Čeká se na dodatečné opravy od autora', 'ROLE_AUTOR'],
        ['Čeká na dodatečné vyjádření ze strany recenzenta', 'Čeká se na dodatečné vyjádření od recenzenta', 'ROLE_RECENZENT'],
        ['Čeká na vyjádření šéfredaktora', 'Čeká se na vyjádření šéfredaktora', 'ROLE_SEFREDAKTOR'],
        ['Přijato', 'Článek byl přijat k publikaci', 'ROLE_REDAKTOR'],
        ['Zamítnuto', 'Článek byl zamítnut', 'ROLE_REDAKTOR'],
        ['Přijato s výhradami', 'Článek byl přijat s výhradami', 'ROLE_REDAKTOR']
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