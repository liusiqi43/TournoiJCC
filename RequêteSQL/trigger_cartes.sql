
CREATE OR REPLACE FUNCTION check_cartes_type_e() RETURNS trigger AS $t_type_e$
    DECLARE
        count_carte int4;
    BEGIN
        SELECT count(*) INTO count_carte
        FROM tCartesInvention ti, tCartesRessource tr
        WHERE ti.nom = NEW.nom OR tr.nom = NEW.nom;

        IF count_carte > 0 THEN
            RAISE EXCEPTION 'Une carte ne peut être que d un seul type!';
        END IF;

        RETURN NEW;
    END;
$t_type_e$ LANGUAGE plpgsql;

CREATE TRIGGER t_type_e BEFORE INSERT OR UPDATE ON tCartesEffet
    FOR EACH ROW EXECUTE PROCEDURE check_cartes_type_e();



CREATE OR REPLACE FUNCTION check_cartes_type_i() RETURNS trigger AS $t_type_i$
    DECLARE
        count_carte int4;
    BEGIN
        SELECT count(*) INTO count_carte
        FROM tCartesRessource tr, tCartesEffet te
        WHERE tr.nom = NEW.nom OR te.nom = NEW.nom;

        IF count_carte > 0 THEN
            RAISE EXCEPTION 'Une carte ne peut être que d un seul type!';
        END IF;

        RETURN NEW;
    END;
$t_type_i$ LANGUAGE plpgsql;

CREATE TRIGGER t_type_i BEFORE INSERT OR UPDATE ON tCartesInvention
    FOR EACH ROW EXECUTE PROCEDURE check_cartes_type_i();




CREATE OR REPLACE FUNCTION check_cartes_type_r() RETURNS trigger AS $t_type_r$
    DECLARE
        count_carte int4;
    BEGIN
        SELECT count(*) INTO count_carte
        FROM tCartesInvention ti, tCartesEffet te
        WHERE ti.nom = NEW.nom OR te.nom = NEW.nom;

        IF count_carte > 0 THEN
            RAISE EXCEPTION 'Une carte ne peut être que d un seul type!';
        END IF;

        RETURN NEW;
    END;
$t_type_r$ LANGUAGE plpgsql;

CREATE TRIGGER t_type_r BEFORE INSERT OR UPDATE ON tCartesRessource
    FOR EACH ROW EXECUTE PROCEDURE check_cartes_type_r();
