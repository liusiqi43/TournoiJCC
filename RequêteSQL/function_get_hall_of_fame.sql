-- create type hof_year as (annee int);
-- create type halloffame_line as (annee int, nick varchar, login varchar, type varchar, count int);

CREATE OR REPLACE FUNCTION  get_hall_of_fame(lim int) RETURNS SETOF halloffame_line AS $$
    DECLARE
        hof_year hof_year%rowtype;
        output halloffame_line%rowtype;
    BEGIN
        FOR hof_year IN
        SELECT annee FROM ttournois
        LOOP
            FOR output IN
                select champion.annee, champion.nick, champion.login, function_determine_card_type(td.nom) as type, count(*) as count
                FROM tdecks td,
                    (select nick, login, year as annee
                        FROM get_matches_infos_for_all(hof_year.annee)
                            WHERE elimine = false
                                ORDER BY win DESC, total ASC
                                    LIMIT lim) as champion
                WHERE td.login = champion.login AND td.annee = champion.annee
                GROUP BY champion.login, champion.nick, champion.annee, type
            LOOP
                RETURN NEXT output;
            END LOOP;
        END LOOP;
        RETURN;
    END
$$ LANGUAGE plpgsql;
