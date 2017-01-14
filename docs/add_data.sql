-- Function: add_data()

-- DROP FUNCTION add_data();

CREATE OR REPLACE FUNCTION add_data(
    OUT counting integer,
    OUT uids integer[],
    OUT subject_names character[],
    OUT lenght_of_array integer)
  RETURNS record AS
$BODY$
declare var_column_names character varying;
declare m character varying;
    BEGIN

	select array(select name from subject_table where subject_id like 'P%') into subject_names;
	select array(select uid from type) into uids ;
	select array_length(uids,1) into lenght_of_array;
	drop  table if exists Marks8Final;
	create  table Marks8Final (student_id int);
	counting =0;
		FOREACH m  IN ARRAY subject_names
		 LOOP
		 RAISE INFO '%',m;
		 EXECUTE format('ALTER TABLE %s ADD COLUMN %I %s', 'Marks8Final', m, 'character varying');

		END LOOP;
    END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION add_data()
  OWNER TO postgres;
