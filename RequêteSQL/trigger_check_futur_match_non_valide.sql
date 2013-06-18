
CREATE OR REPLACE FUNCTION check_futur_match_non_valide() RETURNS trigger AS $t_check_futur_match$
    DECLARE
        result int4;
        futur bool;
    BEGIN
        IF NEW.jour > now()::date OR (NEW.jour=now()::date AND NEW.horaire=now()::time) THEN
            futur = true;
        ELSE
            futur = false;
        END IF;

        IF NEW.victoire != 0 AND futur THEN
            RAISE EXCEPTION 'Ce match n a pas ete joue, il faut pas le valider!';
        END IF;

        RETURN NEW;
    END;
$t_check_futur_match$ LANGUAGE plpgsql;

CREATE TRIGGER t_check_futur_match BEFORE INSERT OR UPDATE ON tMatchs
    FOR EACH ROW EXECUTE PROCEDURE check_futur_match_non_valide();

