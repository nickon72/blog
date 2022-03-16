<?php
namespace App\Services;

use Aura\SqlQuery\QueryFactory;
use PDO;

class Database
{
    private $pdo;
    private $table;
    private $queryFactory;

    public function __construct(PDO $PDO, QueryFactory $queryFactory)
    {
        $this->pdo = $PDO;
        $this->queryFactory = $queryFactory;
    }

    public function all($table, $limit = null)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->limit($limit);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all_post_category($table, $limit = null, $category_id = false)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('category_id = :category_id')
            ->limit($limit)
            ->bindValue('category_id', $category_id);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all_category($table, $limit = null)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->limit($limit);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());
        $cats =  $sth->fetchAll(PDO::FETCH_ASSOC);

        foreach($cats as $value){
            $categories[$value['parent']][] = $value;
        }

        return $categories;
    }


    public  function build_tree($cats,$parent){
        if(is_array($cats) and isset($cats[$parent])){
            $tree = "<div><ul>";
            foreach($cats[$parent] as $cat){
                $tree .= "<li style='list-style-type: none'><div style='position:absolute'>".$cat['id']." #".$cat['title']."</div>
                    <div align='right'>
                      <a href='#' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='/admin/categories/".$cat['id']."/edit' class='btn btn-warning'><i class='fa fa-pencil'></i></a>
                                            <a href='/admin/categories/".$cat['id']."/delete' class='btn btn-danger' onclick='return confirm('Вы уверены?');'>
                                                <i class='fa fa-remove'></i></a>
                                            </a><a href='/admin/categories/".$cat['id']."/create_children' class='btn btn-warning'>
                                                <i class='fa fa-sort-amount-asc'></i></a>
                    </div><hr>";
                $tree .=  $this->build_tree($cats,$cat['id']);
                $tree .= "</li>";
            }
            $tree .= "</ul></div>";
        }
        else return null;
        return $tree;
    }

    public  function menu_tree($cats,$parent){
        $tree = "";
        if(is_array($cats) and isset($cats[$parent])){

            foreach($cats[$parent] as $cat){
                $tree .= "<li><a href=/kurses/" . $cat['slug'] . " target=_blank>".$cat['title']."</a>
                               <ul class='dropdown-menu'>";
                         if(is_array($cats[$cat['id']])) {
                             foreach ($cats[$cat['id']] as $children) {
                                 $tree .= "<li><a href=/kurses/" . $children['slug'] . " target=_blank>" . $children['title'] . "</a></li>";
                             }
                         }
                             $tree .= "</ul></li>";
            }
        }
    else return null;
        return $tree;
    }



    public function find_all_where($table, $row, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where("$row = :id")
            ->bindValue(":id", $id);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find_all_where_comments($table, $row, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where("$row = :id")
            ->where('status = 1')
            ->bindValue(":id", $id);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function popular_post($table,$row,$limit)

        {
            $select = $this->queryFactory->newSelect();
            $select->cols(['*'])
                ->from($table)
                ->orderBy(["$row DESC"])->limit($limit);
            $sth = $this->pdo->prepare($select->getStatement());
            $sth->execute($select->getBindValues());

            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }

    public function popular_post_comment($table,$row,$limit)

    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('status = 1')
            ->orderBy(["$row DESC"])->limit($limit);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($table,$id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function find_name_tags($table,$slug)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['title'])
            ->from($table)
            ->where('slug = :slug')
            ->bindValue('slug', $slug);
        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }


    public function find_id($table,$row, $slug)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['id'])
            ->from($table)
       //     ->where('slug = :slug')
       //     ->bindValue('slug', $slug);
        ->where("$row = :row")
        ->bindValue(':row', $slug);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    function  getPaginatedFrom_post_for_tag($table,$tag_id,$page = 1, $rows = 1)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
               ->from($table)
               ->where(" id IN (SELECT post_id FROM `post_tags` where tag_id = $tag_id)")
               ->bindValue('id', $tag_id)
                ->page($page)
                ->setPaging($rows);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    function  post_for_tag($table,$id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where(" id IN (SELECT post_id FROM `post_tags` where tag_id = $id)")
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    public function find_tag($post_id)
    {
        $select = $this->queryFactory->newSelect();
        $select->distinct()->cols(['t.title'])
            ->from('tags As t')
            ->from('post_tags As p')
            ->where('t.id = p.tag_id')
            ->where('post_id = :post_id')
            ->bindValue('post_id', $post_id);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

 public function count_category_post()
 {
     $select = $this->queryFactory->newSelect();
     $select->cols(['COUNT(*) as count','c.id','c.title','c.slug'])
         ->from('categories_blog As c')
         ->from('posts As p')
         ->where('c.id = p.category_id')
         ->groupBy(['p.category_id']) ;

     $sth = $this->pdo->prepare($select->getStatement());
     $sth->execute($select->getBindValues());

     return $sth->fetchAll(PDO::FETCH_ASSOC);
 }

  public function kurses()
  {
      $select = $this->queryFactory->newSelect();
      $select->cols(['p.id as rod','c.id as child','p.title as roditel','c.title as children'])
          ->from('categories As p')
          ->from('categories As c')
          ->where('p.id = c.parent and p.parent = 0');
      $sth = $this->pdo->prepare($select->getStatement());
      $sth->execute($select->getBindValues());

     return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

    public function out_link_kurses($link_kurses)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['link'])
            ->from('categories')
            ->where('slug = :slug')
            ->bindValue('slug', $link_kurses);
        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }


    public function create($table,$data)
    {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($table)
            ->cols($data);

        $sth = $this->pdo->prepare($insert->getStatement());

        $sth->execute($insert->getBindValues());

        $name = $insert->getLastInsertIdName('id');

        return $this->pdo->lastInsertId($name);
    }

    public function update($table,$id, $data)
    {
        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)                  // update this table
            ->cols($data)
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($update->getStatement());

        $sth->execute($update->getBindValues());
    }

    public function toggle_on($table,$id)
    {
        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)
            ->where('id = :id')
            ->bindValue('id', $id)
            ->cols([                    // update these columns and bind these values
                'status' => '1',
            ]);
        $sth = $this->pdo->prepare($update->getStatement());

        $sth->execute($update->getBindValues());
    }
    public function toggle_off($table,$id)
    {
        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)
            ->where('id = :id')
            ->bindValue('id', $id)
            ->cols([                    // update these columns and bind these values
                'status' => '0',
            ]);
        $sth = $this->pdo->prepare($update->getStatement());

        $sth->execute($update->getBindValues());
    }
       public function delete($table,$id)
    {
        $delete = $this->queryFactory->newDelete();

        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($delete->getStatement());

        $sth->execute($delete->getBindValues());
    }

    public function delete_post_tag($table,$post_id)
    {
        $delete = $this->queryFactory->newDelete();

        $delete
            ->from($table)
            ->where('post_id = :post_id')
            ->bindValue('post_id', $post_id);

        $sth = $this->pdo->prepare($delete->getStatement());

        $sth->execute($delete->getBindValues());
    }

    public function getPaginatedFrom_all($table,$page = 1, $rows = 1)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->page($page)
            ->setPaging($rows);
        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginatedFrom($table,$row, $id, $page = 1, $rows = 1)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where("$row = :row")
            ->bindValue(':row', $id)
            ->page($page)
            ->setPaging($rows);
        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCount_all($table)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return count($sth->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getCount($table, $row, $value)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where("$row = :$row")
            ->bindValue($row, $value);


        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return count($sth->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getCount_on($table, $row, $value)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where("$row = :$row")
            ->where('status = 1')
            ->bindValue($row, $value);


        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return count($sth->fetchAll(PDO::FETCH_ASSOC));
    }

    public function whereAll($table, $row, $id,  $limit = 4)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->limit($limit)
            ->where("$row = :id")
            ->bindValue(":id", $id);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search_Word($table,$value)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['title','slug'])
            ->from($table)
            ->where("title LIKE '%$value%'")
            ->bindValue($value, $value);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


}