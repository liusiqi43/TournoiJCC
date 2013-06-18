CREATE OR REPLACE FUNCTION check_coherence_tournoi() RETURNS trigger AS $t_coherence_tournoi$
    DECLARE
        count_participation int4;
    BEGIN
        SELECT count(*) INTO count_participation
        FROM tParticipations tp
        WHERE tp.annee = NEW.annee_tournoi AND (tp.login = NEW.j1 OR tp.login = NEW.j2);

        IF count_participation <> 2 THEN
            RAISE EXCEPTION 'Joueur 1 ou Joeur 2 ne sont pas inscrit comme participant à ce tournoi!';
        END IF;

        RETURN NEW;
    END;
$t_coherence_tournoi$ LANGUAGE plpgsql;

CREATE TRIGGER t_coherence_tournoi BEFORE INSERT OR UPDATE ON tMatchs
    FOR EACH ROW EXECUTE PROCEDURE check_coherence_tournoi();
