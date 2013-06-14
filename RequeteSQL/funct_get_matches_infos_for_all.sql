
-- create type holder as (login varchar, nick varchar);

-- create type infoLine as (year int, login varchar, nick varchar, win int, lose int, total int);

CREATE OR REPLACE FUNCTION get_matches_infos_for_all(year int) RETURNS SETOF infoLine AS $$
    DECLARE
        r holder%rowtype;
        output infoLine%rowtype;
    BEGIN

        FOR r in 
        SELECT login, surnom 
        FROM tParticipations tp 
        WHERE tp.annee = year LOOP

        SELECT year, login, nick, win, lose, total INTO output FROM get_matches_infos(year, 
            r.login,
            r.nick
        );

        return NEXT output;
        end loop;
        RETURN;
    END;
$$ LANGUAGE plpgsql;
