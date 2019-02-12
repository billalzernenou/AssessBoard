<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190204142041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, ue_id INT NOT NULL, sessions_id INT NOT NULL, question_type_id INT NOT NULL, mark VARCHAR(255) DEFAULT NULL, INDEX IDX_50D0C60662E883B1 (ue_id), INDEX IDX_50D0C606F17C4D8C (sessions_id), INDEX IDX_50D0C606CB90598E (question_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composantes (id INT AUTO_INCREMENT NOT NULL, etablisseent_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_8EBC0B0D48068D5 (etablisseent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sessions (id INT AUTO_INCREMENT NOT NULL, questionnaire_id INT NOT NULL, email VARCHAR(255) DEFAULT NULL, is_done TINYINT(1) DEFAULT NULL, INDEX IDX_9A609D13CE07E8FF (questionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, questionnaire_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, has_tdtp TINYINT(1) DEFAULT NULL, has_lessons TINYINT(1) DEFAULT NULL, INDEX IDX_2E490A9BCE07E8FF (questionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissements (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire (id INT AUTO_INCREMENT NOT NULL, composant_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, promo VARCHAR(255) NOT NULL, year INT NOT NULL, INDEX IDX_7A64DAF7F3310E7 (composant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C60662E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sessions (id)');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606CB90598E FOREIGN KEY (question_type_id) REFERENCES question_type (id)');
        $this->addSql('ALTER TABLE composantes ADD CONSTRAINT FK_8EBC0B0D48068D5 FOREIGN KEY (etablisseent_id) REFERENCES etablissements (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D13CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9BCE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF7F3310E7 FOREIGN KEY (composant_id) REFERENCES composantes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF7F3310E7');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C606F17C4D8C');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C606CB90598E');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C60662E883B1');
        $this->addSql('ALTER TABLE composantes DROP FOREIGN KEY FK_8EBC0B0D48068D5');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D13CE07E8FF');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9BCE07E8FF');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE composantes');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP TABLE question_type');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE etablissements');
        $this->addSql('DROP TABLE questionnaire');
        $this->addSql('DROP TABLE user');
    }
}
