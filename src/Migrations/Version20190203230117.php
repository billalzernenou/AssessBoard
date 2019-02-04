<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190203230117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE composantes ADD etablisseent_id INT NOT NULL');
        $this->addSql('ALTER TABLE composantes ADD CONSTRAINT FK_8EBC0B0D48068D5 FOREIGN KEY (etablisseent_id) REFERENCES etablissements (id)');
        $this->addSql('CREATE INDEX IDX_8EBC0B0D48068D5 ON composantes (etablisseent_id)');
        $this->addSql('ALTER TABLE ue ADD has_lessons TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE questionnaire ADD title VARCHAR(255) NOT NULL, ADD promo VARCHAR(255) NOT NULL, ADD year INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE composantes DROP FOREIGN KEY FK_8EBC0B0D48068D5');
        $this->addSql('DROP INDEX IDX_8EBC0B0D48068D5 ON composantes');
        $this->addSql('ALTER TABLE composantes DROP etablisseent_id');
        $this->addSql('ALTER TABLE questionnaire DROP title, DROP promo, DROP year');
        $this->addSql('ALTER TABLE ue DROP has_lessons');
    }
}
