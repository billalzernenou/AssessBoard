<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190203233726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sessions (id INT AUTO_INCREMENT NOT NULL, questionnaire_id INT NOT NULL, email VARCHAR(255) DEFAULT NULL, is_done TINYINT(1) DEFAULT NULL, INDEX IDX_9A609D13CE07E8FF (questionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D13CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('DROP TABLE session');
        $this->addSql('ALTER TABLE answers ADD ue_id INT NOT NULL, ADD sessions_id INT NOT NULL, ADD question_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C60662E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sessions (id)');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606CB90598E FOREIGN KEY (question_type_id) REFERENCES question_type (id)');
        $this->addSql('CREATE INDEX IDX_50D0C60662E883B1 ON answers (ue_id)');
        $this->addSql('CREATE INDEX IDX_50D0C606F17C4D8C ON answers (sessions_id)');
        $this->addSql('CREATE INDEX IDX_50D0C606CB90598E ON answers (question_type_id)');
        $this->addSql('ALTER TABLE ue ADD questionnaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9BCE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('CREATE INDEX IDX_2E490A9BCE07E8FF ON ue (questionnaire_id)');
        $this->addSql('ALTER TABLE questionnaire ADD composant_id INT NOT NULL');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF7F3310E7 FOREIGN KEY (composant_id) REFERENCES composantes (id)');
        $this->addSql('CREATE INDEX IDX_7A64DAF7F3310E7 ON questionnaire (composant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C606F17C4D8C');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, is_done TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C60662E883B1');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C606CB90598E');
        $this->addSql('DROP INDEX IDX_50D0C60662E883B1 ON answers');
        $this->addSql('DROP INDEX IDX_50D0C606F17C4D8C ON answers');
        $this->addSql('DROP INDEX IDX_50D0C606CB90598E ON answers');
        $this->addSql('ALTER TABLE answers DROP ue_id, DROP sessions_id, DROP question_type_id');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF7F3310E7');
        $this->addSql('DROP INDEX IDX_7A64DAF7F3310E7 ON questionnaire');
        $this->addSql('ALTER TABLE questionnaire DROP composant_id');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9BCE07E8FF');
        $this->addSql('DROP INDEX IDX_2E490A9BCE07E8FF ON ue');
        $this->addSql('ALTER TABLE ue DROP questionnaire_id');
    }
}
