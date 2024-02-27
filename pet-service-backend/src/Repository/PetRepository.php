<?php

namespace App\Repository;

use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Pet>
 *
 * @method Pet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pet[]    findAll()
 * @method Pet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Pet::class);
        $this->manager = $manager;
    }
    public function savePet($name, $breed, $type, $gender)
    {
        $newPet = new Pet();

        $newPet
            ->setName($name)
            ->setBreed($breed)
            ->setType($type)
            ->setGender($gender);
        $this->manager->persist($newPet);
        $this->manager->flush();
    }

//    /**
//     * @return Pet[] Returns an array of Pet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pet
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
