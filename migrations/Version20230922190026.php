<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922190026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assessments (id INT AUTO_INCREMENT NOT NULL, schedule_id INT DEFAULT NULL, comments LONGTEXT NOT NULL, INDEX IDX_4BFCEC0AA40BC2D5 (schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedules (id INT AUTO_INCREMENT NOT NULL, inspector_id INT DEFAULT NULL, job_id INT DEFAULT NULL, date DATETIME NOT NULL, completed TINYINT(1) NOT NULL, INDEX IDX_313BDC8ED0E3F35F (inspector_id), INDEX IDX_313BDC8EBE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assessments ADD CONSTRAINT FK_4BFCEC0AA40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedules (id)');
        $this->addSql('ALTER TABLE schedules ADD CONSTRAINT FK_313BDC8ED0E3F35F FOREIGN KEY (inspector_id) REFERENCES inspectors (id)');
        $this->addSql('ALTER TABLE schedules ADD CONSTRAINT FK_313BDC8EBE04EA9 FOREIGN KEY (job_id) REFERENCES jobs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assessments DROP FOREIGN KEY FK_4BFCEC0AA40BC2D5');
        $this->addSql('ALTER TABLE schedules DROP FOREIGN KEY FK_313BDC8ED0E3F35F');
        $this->addSql('ALTER TABLE schedules DROP FOREIGN KEY FK_313BDC8EBE04EA9');
        $this->addSql('DROP TABLE assessments');
        $this->addSql('DROP TABLE schedules');
    }
}
