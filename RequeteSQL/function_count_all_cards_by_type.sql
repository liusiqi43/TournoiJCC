

create type infoLine_cardtype as (card_count bigint, type text);

CREATE OR REPLACE FUNCTION function_determine_card_type() RETURNS setof infoLine_cardtype as $$
    BEGIN
    	RETURN QUERY 
    	select count(nom) as card_count, type 
    	FROM (	select nom, 'invention' as type from tcartes 
    				intersect 
    		  	select nom, 'invention' as type from tcartesinvention as ti 
    		UNION 
    			select nom, 'effet' as type from tcartes 
    				intersect 
    			select nom, 'effet' as type from tcarteseffet as te 
    		UNION 
    			select nom, 'ressource' as type from tcartes 
    				intersect 
    			select nom, 'ressource' as type from tcartesressource as tr) 
    		as tall group by type;
    END;
$$ LANGUAGE plpgsql;
