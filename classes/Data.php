<?php
require_once("sparqllib.php");

class Data
{
    public $query;
    public $criteria;
    public $order;
    public $results;
    public $fields;
    public $limit=10;
    public $offset;

    public function __construct($data)
    {
        $this->criteria=$_POST['criteria'];
        $this->order=$_POST['order'];
        $this->limit=$_POST['k'];


       /* echo "<pre>";
        print_r($_POST);*/
        $db = sparql_connect("http://dbpedia.org/sparql");
        if (!$db) {
            print sparql_errno() . ": " . sparql_error() . "\n";
            exit;
        }
        sparql_ns("foaf", "http://xmlns.com/foaf/0.1/");
    }


    public function configure()
    {
        $this->query = "PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX dbo: <http://dbpedia.org/ontology/>
select *
where {
?Writer a dbo:Writer. ";

        if ($this->criteria == "Education") {
            //echo "hi";
            $this->query .= "?Writer dbo:education ?Education. ";
        }
        if ($this->criteria == "Birth Place") {
            $this->query .= "?Writer dbo:birthPlace  ?BirthPlace. ";
        }
        if ($this->criteria == "Nation") {
            $this->query .= "?Writer dbo:nationality ?Nation. ";
        }
        if ($this->criteria == "CitizenShip") {
            $this->query .= "?Writer dbo:citizenship ?city. ";
        }
        if ($this->order == "DeathDate") {
            $this->query .= "?Writer dbo:deathDate ?deathDate.} ORDER BY ?deathDate LIMIT $this->limit ";

        }
        if ($this->order == "BirthDate") {
            $this->query .= "?Writer dbo:birthDate ?birthDate.} ORDER BY ?birthDate LIMIT $this->limit  ";
        }
        //return $this->query;



    }

    public function run()
    {
        $this->results = sparql_query($this->query);
        if (!$this->results) {
            print sparql_errno() . ": " . sparql_error() . "\n";
            exit;}
            $this->fields = sparql_field_array($this->results);
            print "<p>Number of rows according to $this->criteria and ordered by $this->order " . sparql_num_rows($this->results) . " results.</p>";
            print "<table class='table-bordered'>";
            print "<tr>";
            foreach ($this->fields as $field) {
                print "<th>$field</th>";
            }
            print "</tr>";
            while ($row = sparql_fetch_array($this->results)) {
                print "<tr>";
                foreach ($this->fields as $field) {
                    print "<td>$row[$field]</td>";
                }
                print "</tr>";
            }
            print "</table>";
        }


}

?>

