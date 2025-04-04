<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250403223549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '(Re-)Create table for token authentication';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof AbstractMySQLPlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\AbstractMySQLPlatform'."
        );

        $schema->dropTable('flownative_tokenauthentication_security_model_hashandroles');
        $this->addSql(<<<'SQL'
            CREATE TABLE flownative_tokenauthentication_security_model_hashandroles (hash VARCHAR(255) NOT NULL, roleshash VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:flow_json_array)', settings JSON NOT NULL COMMENT '(DC2Type:flow_json_array)', PRIMARY KEY(hash)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof AbstractMySQLPlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\AbstractMySQLPlatform'."
        );

        $schema->dropTable('flownative_tokenauthentication_security_model_hashandroles');
    }
}
