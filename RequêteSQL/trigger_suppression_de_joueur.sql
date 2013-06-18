CREATE OR REPLACE FUNCTION suppression_de_joueur() RETURNS trigger AS $t_supjoueur_e$
    DECLARE
        count_j int4;
    BEGIN
        SELECT count(*) INTO count_j
        FROM tParticipations tp
        WHERE tp.login = OLD.login;

        IF count_j = 0 THEN
            DELETE FROM tjoueurs WHERE tjoueurs.login = OLD.login;
        END IF;

        RETURN NEW;
    END;
$t_supjoueur_e$ LANGUAGE plpgsql;

CREATE TRIGGER t_supjoueur_e AFTER DELETE ON tParticipations
    FOR EACH ROW EXECUTE PROCEDURE suppression_de_joueur();