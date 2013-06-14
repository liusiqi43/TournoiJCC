CREATE OR REPLACE FUNCTION check_un_joueur_pas_deux_matches() RETURNS trigger AS $t_joueur_deux_match$
    DECLARE
        count_match int4;
    BEGIN
        SELECT count(*) INTO count_match
        FROM tMatchs tm
        WHERE ((tm.j1 = NEW.j1) OR (tm.j1 = NEW.j2) OR (tm.j2 = NEW.j1) OR (tm.j2 = NEW.j2)) AND 
        tm.annee_tournoi = NEW.annee_tournoi AND tm.horaire = NEW.horaire AND tm.jour = NEW.jour;

        IF count_match > 0 THEN
            RAISE EXCEPTION 'Joueur 1 ou Joeur 2 est déjà occupé à cette heure-ci!';
        END IF;

        RETURN NEW;
    END;
$t_joueur_deux_match$ LANGUAGE plpgsql;

CREATE TRIGGER t_joueur_deux_match BEFORE INSERT OR UPDATE ON tMatchs
    FOR EACH ROW EXECUTE PROCEDURE check_un_joueur_pas_deux_matches();
