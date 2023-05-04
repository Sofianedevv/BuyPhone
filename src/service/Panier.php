<?php


class Panier
{
    public static function destroy()
    {
        unset($_SESSION['panier']);
    }

    public static function add(int $id, string $nomProduit, int $nbr=1)
    {
        $panier = $_SESSION['panier'];
        switch($nomProduit){
            case 'telephone':
                $produit = Telephone::findById(['id' => $id]);
            break;
            case 'accessoire':
                $produit = Accessoire::findById(['id' => $id]);
            break;
        }
        

        if(!empty($panier[$nomProduit][$id])):

            $quantityBddProduit = $produit['quantity'];
            if($quantityBddProduit >= $panier[$nomProduit][$id] + $nbr):
                $panier[$nomProduit][$id] += $nbr;
            else:
                $panier[$nomProduit][$id] = $quantityBddProduit;
                $_SESSION['messages']['danger'][] = "Nous avons que $quantityBddProduit en stock pour ce model de téléphone";
            endif;
        else:
            $panier[$nomProduit][$id] = $nbr;
        endif;
        // var_dump($panier);
        // var_dump($_SESSION['panier']);
        $_SESSION['panier']= $panier;
    }

    public static function remove(int $id, string $produit)
    {
        $panier = $_SESSION['panier'];
        if(!empty($panier[$produit][$id]) && $panier[$produit][$id]!== 1){
            $panier[$produit][$id]--;
        }
        else{
            unset($panier[$produit][$id]);
        }
        $_SESSION['panier'] = $panier;
    }

    public static function delete(int $id, string $produit)
    {
        $panier = $_SESSION['panier'];

        if(!empty($panier[$produit][$id])){
            unset($panier[$produit][$id]);
        }
        $_SESSION['panier'] = $panier;
    }

    public static function getDetailPanier(){
        $detailPanier = [];
        if(isset($_SESSION['panier'])):
            $panier = $_SESSION['panier'];
            

        foreach ($panier as $nomProduit => $produit)
        {   foreach($produit as $id => $quantity)
            {
                switch($nomProduit){
                    case 'telephone':
                        $produit = Telephone::findById(['id' => $id]);
                    break;
                    case 'accessoire':
                        $produit = Accessoire::findById(['id' => $id]);
                    break;
                }
                $detailPanier[] = [
                    $nomProduit => $produit,
                    'quantity' => $quantity,
                    'total' =>  $produit['prix'] * $quantity
                ];
            }
        }
        endif;
        return $detailPanier;



    }

    public static function getTotal()
    {
        $total = 0;

        foreach(self::getDetailPanier() as $panierProduit)
        {
            $total += $panierProduit['total'];

        }
        return $total;

    } 

    public static function getPanier()
    {

        $panier = $_SESSION['panier'];
        $panierProduits = [];
        foreach($panier as $id => $quantity)
        {
            $panierProduits[] = Telephone::findById(['id' => $id]);
        }

        return $panierProduits;
    }







}