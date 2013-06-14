
create type login_holder as (login varchar);

-- create type infoLine as (year int, login varchar, nick varchar, win int, lose int, total int);

CREATE OR REPLACE FUNCTION getLoginForNonOrgOrJoueur(year int, type int) RETURNS SETOF varchar AS $$
    DECLARE
        r login_holder%rowtype;
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
