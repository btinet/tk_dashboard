<?php

namespace Core\Model\RepositoryFactory;

interface RepositoryFactoryInterface
{

    /**
     * @param int|string $id Primärschlüssel des Entity-Objekts.
     * @return null|object Gibt ein Entity-Objekt oder NULL zurück.
     */
    public function find($id):?object;

    /**
     * @param array $data Felder und Werte der Suchkriterien.
     * @return null|object Gibt ein Entity-Objekt zurück, das den Suchkriterien entspricht.
     * Entspricht kein Objekt den Suchkriterien, wird NULL zurückgegeben.
     */
    public function findOneBy(array $data): ?object;

    /**
     * @param array $data Felder und Werte der Suchkriterien.
     * @param array $orderBy Felder und Richtungen nach denen sortiert wird.
     * @param int|null $limit Maximale Anzahl der Datensätze.
     * @param int|null $offset Erster Datensatz.
     * @return array Gibt ein Array mit Entity-Objekten zurück, die den Suchkriterien entsprechen.
     * Entspricht kein Objekt den Suchkriterien, wird ein leeres Array zurückgegeben.
     */
    public function findBy(array $data, array $orderBy = [], int $limit = null, int $offset = null): array;

    /**
     * @param array $orderBy Felder und Richtungen nach denen sortiert wird.
     * @param int|null $limit Maximale Anzahl der Datensätze.
     * @param int|null $offset Erster Datensatz.
     * @return array Gibt ein Array mit Entity-Objekten zurück.
     */
    public function findAll(array $orderBy = [], int $limit = null, int $offset = null ): array;

}
