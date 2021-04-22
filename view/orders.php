<main id="orders" class="container">
    <h1> Mes commandes</h1>
    <section>
        <ul>
            <?php foreach($orders as $order): ?>
                <li>
                    <a data-order =  <?= $order['id'] ?> data-status = <?= $order['status']?>> Commande n° <?= $order['id'] ?> (<?= $tools->convertDate($order['date']) ?>) - Statut : <?= $tools->translateStatus($order['status']) ?> </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <div id="message"></div>
    <script src="http://js.stripe.com/v3/"></script>
    <script src="public/js/orders.js" type='module'></script>
</main>