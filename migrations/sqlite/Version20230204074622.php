<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230204074622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_links (user_id INTEGER NOT NULL, lm_id INTEGER NOT NULL, PRIMARY KEY(user_id, lm_id), CONSTRAINT FK_36F50551A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_36F50551CAAC5EAD FOREIGN KEY (lm_id) REFERENCES links_map (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_36F50551A76ED395 ON users_links (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36F50551CAAC5EAD ON users_links (lm_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_links');
    }
}
