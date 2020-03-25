<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    public function findAllOrderByStatusAndCreationDate()
    {
        $query = $this->createQueryBuilder('t')
            ->orderBy('t.status', 'ASC')
            ->addOrderBy('t.creationDate', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param int $delay
     * @return QueryBuilder
     * @throws \Exception
     */
    public function bulkUpdateContactTicketCloseAfterDelay(int $delay)
    {
        $queryBuilder = $this->ticketClosedAfterDelayQueryBuilder($delay);
        return $queryBuilder
            ->update()
            ->set('t.contact', ':contact')
            ->setParameter('contact', null)
            ->getQuery()
            ->execute();
    }

    /**
     * @param int $delay
     * @return \Doctrine\ORM\QueryBuilder
     * @throws \Exception
     */
    private function ticketClosedAfterDelayQueryBuilder(int $delay): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('t');

        return $queryBuilder->where('t.status = :status')
            ->andWhere("DATE_ADD(t.resolvedDate, :delay, 'day') < :currentDate")
            ->setParameters([
                'status' => Ticket::STATUS_CLOSE,
                'delay' => $delay,
                'currentDate' => new \DateTime()
            ]);
    }
}
