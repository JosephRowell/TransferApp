/********************************************************
Database Connection Settings
*********************************************************/

exports.conString = "postgres://postgres:alpaca@localhost:5432/todos";

/*In order for above code to work on your local machine, you need
to have postgres running and put in your
dbusername:dbpassword@localhost:portnum/dbname
*/

/*To have this run locally,
create a db named todos

 CREATE TABLE todos
 (
 id integer NOT NULL DEFAULT nextval('items_id_seq'::regclass),
 text character varying(40) NOT NULL,
 done boolean,
 CONSTRAINT items_pkey PRIMARY KEY (id)
 )
 WITH (
 OIDS=FALSE
 );
 ALTER TABLE todos
 OWNER TO postgres;

 go to the project directory, open cmd and type:

 bower update (just to be safe)
 npm start


 then go to web browser and type: localhost:3090

 Minor bug: Refreshing only works on the home page.
 Only refresh on the home page for now.

 

 */


// module.exports = {
//    query: function(text, values, cb) {
//       pg.connect(function(err, client, done) {
//         client.query(text, values, function(err, result) {
//           done();
//           cb(err, result);
//         })
//       });
//    }
// }

