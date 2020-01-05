<?php declare (strict_types = 1);
namespace Migrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Migration201911232034 class
 */
final class Migration201911232034
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function migrate(): void
    {
        $dropStmt = $this->connection->prepare('DROP TABLE IF EXISTS submissions');
        $dropStmt->execute();

        $schema = new Schema();
        $this->createSubmissionTable($schema);

        $queries = $schema->toSql($this->connection->getDatabasePlatform());
        foreach ($queries as $query) {
            $this->connection->executeQuery($query);
        }
    }

    private function createSubmissionTable(Schema $schema)
    {
        $table = $schema->createTable('submissions');
        $table->addColumn('id', Type::GUID);
        $table->addColumn('title', Type::STRING);
        $table->addColumn('url', Type::STRING);
        $table->addColumn('creation_date', Type::DATETIME);
    }
}
