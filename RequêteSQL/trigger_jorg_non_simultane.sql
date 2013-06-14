CREATE OR REPLACE FUNCTION check_joueur_membre_non_simultane() RETURNS trigger AS $t_orgjoueur_e$
    DECLARE
        count_jorg int4;
    BEGIN
        SELECT count(*) INTO count_jorg
        FROM tOrganisateurs torg, tParticipations tp
        WHERE torg.login = tp.login AND torg.annee = tp.annee;

        IF count_jorg > 0 THEN
            RAISE EXCEPTION 'Un joueur ne peut pas être un organisateur en même temps!';
        END IF;

        RETURN NEW;
    END;
$t_orgjoueur_e$ LANGUAGE plpgsql;

CREATE TRIGGER t_orgjoueur_e AFTER INSERT OR UPDATE ON tOrganisateurs
    FOR EACH ROW EXECUTE PROCEDURE check_joueur_membre_non_simultane();