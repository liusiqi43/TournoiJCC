
CREATE OR REPLACE FUNCTION check_30_cartes() RETURNS trigger AS $t_30cartes$
    DECLARE
        count_carte int4;
    BEGIN
        SELECT count(*) INTO count_carte
        FROM tDecks td
        WHERE td.login = NEW.login AND td.annee = NEW.annee;

        IF count_carte = 30 THEN
            RAISE EXCEPTION 'un deck ne peut contenir que 30 cartes!';
        END IF;

        RETURN NEW;
    END;
$t_30cartes$ LANGUAGE plpgsql;

CREATE TRIGGER t_30cartes BEFORE INSERT OR UPDATE ON tDecks
    FOR EACH ROW EXECUTE PROCEDURE check_30_cartes();
