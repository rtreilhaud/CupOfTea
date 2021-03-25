<main id="listing" class="container">
    <h1>Notre carte des thés</h1>
    <?php foreach($categories as $category): ?>
        <section >
            <h2 id="<?= str_replace(' ', '',$category['name']); ?>">
                <span><?= htmlspecialchars($category['name']) ?></span>
            </h2>
            <p><?= htmlspecialchars($category['content']) ?></p>
            <div class="flex">
                <?php 
                    $products = $productMod->fetchProductsFromCategory($category['id']);

                    foreach($products as $product):
                ?>
                    <article class="flex">
                        <figure>
                            <figcaption>
                                <h3><?= htmlspecialchars($product['name']) ?></h3>
                            </figcaption>
                            <img src="public/img/product/<?= $product['picture']; ?>" alt="<?= $product['name']; ?>">
                            <p><?= htmlspecialchars($product['content']); ?></p>
                        </figure>
                        <div>
                            <p>  A partir de </p>
                            <p class="price"> <?= str_replace('.', ',', $product['price']); ?> € </p>
                            <a href="index.php?page=product&pID=<?= intval($product['id']); ?>" class="btn"> Voir ce produit </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>

    <!-- <section >
       <h2 id="the-noir"><span>Thé Noir</span></h2>
        <p>
            Le thé noir, que les chinois appellent thé rouge en référence à la couleur cuivrée de son infusion, est un thé complètement oxydé. La fabrication du thé noir, se fait en cinq étapes : le fleurissage, le roulage, l'oxydation, la torréfaction et le triage. Cette dernière opération permet de différencier les différents grades.
        </p>
        <div class="flex">
            <article>
                <figure>
                    <figcaption><h3> Blue of London </h3></figcaption>
                    <img src="img/product/product3_big.jpg" alt="Blue of London">
                </figure>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel, totam, culpa quas distinctio nam quidem ipsam ad quod accusantium deleniti ratione labore minima quia inventore officiis atque aut a facilis laborum explicabo sint nemo quos soluta ipsa aliquid placeat ab! </p>
                <p> A partir de </p>
                <p class="prix"> 9,00€ </p>
                <a href="product.html" class="lien-produit"> Voir ce produit </a>
            </article>
            <article>
                <figure>
                    <figcaption><h3> Thé des Lords </h3></figcaption>
                    <img src="img/product/product6_big.jpg" alt="Thé des Lords">
                </figure>
                <p>Ad, explicabo ea veniam incidunt quas neque libero sequi suscipit enim voluptate! Necessitatibus, perspiciatis, autem alias ipsa assumenda neque fugit libero quibusdam quaerat rem quia sequi qui dolore recusandae inventore! Ab, officiis eligendi amet vero reiciendis tempora laborum praesentium modi?</p>
                <p> A partir de </p>
                <p class="prix"> 8,20 € </p>
                <a href="" class="lien-produit"> Voir ce produit </a>
            </article>
            <article>
                <figure>
                    <figcaption><h3> Thé des vahinés </h3></figcaption>
                    <img src="img/product/product7_big.jpg" alt="Thé des vahinés">
                </figure>
                <p>Libero, eos aperiam distinctio corporis amet! Harum, numquam assumenda mollitia quam expedita dolores beatae dicta saepe! Distinctio, iusto, quia voluptatem incidunt totam perspiciatis maxime aut molestiae magnam repellendus quod facere voluptas enim pariatur explicabo ut nihil temporibus repudiandae ab vel.</p>
                <p> A partir de </p>
                <p class="prix"> 9,40€ </p>
                <a href="" class="lien-produit"> Voir ce produit </a>
            </article>
        </div>
    </section>

    <section>
        <h2 id="the-vert"><span>Thé vert</span></h2>
        <p>
            Réputé pour ses nombreuses vertus grâce à sa richesse en antioxydants, le thé vert désaltère, tonifie, apaise, fortifie et procure une incontestable sensation de bien-être. Délicat et peu amer, il est apprécié à tout moment de la journée et propose une palette d'arômes très variés : végétal, minéral, floral, fruité.
        </p>
        <div class="flex">
        <article>
                    <figure>
                        <figcaption><h3> Thé du hammam </h3></figcaption>
                        <img src="img/product/product1_big.jpg" alt="Thé du hammam">
                    </figure>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, quidem mollitia officia perferendis dolorem ipsam vel in maiores! Velit, atque, nam, distinctio aliquid natus quidem alias modi dicta illo cupiditate necessitatibus optio facilis et debitis tempore fugit similique sapiente vel!</p>
                    <p> A partir de </p>
                    <p class="prix"> 8,50€ </p>
                    <a href="" class="lien-produit"> Voir ce produit </a>
                </article>
                <article>
                    <figure>
                        <figcaption><h3> Vive le thé ! </h3></figcaption>
                        <img src="img/product/product4_big.jpg" alt="Vive le thé !">
                    </figure>
                    <p>Nostrum, rerum, dicta quaerat provident commodi quidem molestiae eligendi vel asperiores. Rem, libero, omnis, quia deserunt eos officiis id adipisci dignissimos explicabo aperiam doloribus hic vel odit magnam nemo consequuntur quaerat cum vitae velit sunt veritatis veniam illo culpa nulla.</p>
                    <p> A partir de </p>
                    <p class="prix"> 6,80€ </p>
                    <a href="" class="lien-produit"> Voir ce produit </a>
                </article>
                <article>
                    <figure>
                        <figcaption><h3> Thé des alizés </h3></figcaption>
                        <img src="img/product/product5_big.jpg" alt="Thé des alizés">
                    </figure>
                    <p>Voluptatum, veniam, cum sit quia temporibus consequuntur dolore reiciendis esse nobis amet ipsum obcaecati deserunt tempora saepe dolorem repudiandae voluptatibus molestiae deleniti magnam quas minus perspiciatis aspernatur eveniet. Ipsum, quas debitis ad sequi consequatur facere accusantium fuga vitae ab aperiam?</p>
                    <p> A partir de </p>
                    <p class="prix"> 9,30€ </p>
                    <a href="" class="lien-produit"> Voir ce produit </a>
                </article>
        </div>
    </section>

    <section>
        <h2 id="the-oolong"><span>Thé Oolong</span></h2>

        <p>
            Les Oolong, que les chinois appellent thé bleu-vert en référence à la couleur de leurs feuilles infusées, sont des thés semi-oxydés : leur oxydation n'a pas été menée à son terme. Spécialités de Chine et de Taïwan, il en existe une grande variété, en fonction de la région de culture, de l'espèce du théier ou encore du processus de fabrication.
        </p>

        <div class="flex">
            <article class="article-tea">
                <h3>Vive les fêtes</h3>

                <img src="public/img/product/product8_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    11,10€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>

            <article class="article-tea">
                <h3>Fleur d'orangér Oolong</h3>

                <img src="public/img/product/product9_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    10,90€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>

            <article class="article-tea">
                <h3>Oolong 7 agrumes</h3>

                <img src="public/img/product/product10_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    13,20€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>
        </div>
    </section>

    <section>
        <h2 id="the-blanc"><span>Thé blanc</span></h2>

        <p>
            Le thé blanc est une spécialité de la province du Fujian. De toutes les familles de thé, c'est celle dont la feuille est la moins transformée par rapport à son état naturel. Non oxydé, le thé blanc ne subit que deux opérations : un flétrissage et une dessication. Il existe deux grands types de thés blancs : les Aiguilles d'Argent et les Bai Mu Dan.
        </p>

        <div class="flex">
            <article class="article-tea">
                <h3>Thé des songes blancs</h3>

                <img src="public/img/product/product11_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    12,00€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>

            <article class="article-tea">
                <h3>Bai mu dan</h3>

                <img src="public/img/product/product12_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    9,50€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>

            <article class="article-tea">
                <h3>Aiguilles d'Argent</h3>

                <img src="public/img/product/product13_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    47,20€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>
        </div>
    </section>

    <section>
        <h2 id="rooibos"><span>Rooibos</span></h2>

        <p>
            Le Rooibos (appelé thé rouge bien qu'il ne s'agisse pas de thé) est une plante poussant uniquement en Afrique du Sud et qui ne contient pas du tout de théine. Son infusion donne une boisson très agréable, ronde et légèrement sucrée. Riche en antioxydants, faible en tanins et dénué de théine, le Rooibos peut être dégusté en journée comme en soirée.
        </p>

        <div class="flex">
            <article class="article-tea">
                <h3>Rooibos à la verveine</h3>

                <img src="public/img/product/product14_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    7,00€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>

            <article class="article-tea">
                <h3>Spicy Passion</h3>

                <img src="public/img/product/product15_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    9,00€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>

            <article class="article-tea">
                <h3>Rooibos des amants</h3>

                <img src="public/img/product/product16_big.jpg" alt="Thé blue of london">

                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, explicabo nemo. Maiores odit molestiae, amet saepe, quo mollitia enim delectus vitae tempora ut totam minus fugit officiis aspernatur eum velit?
                </p>

                <p>
                    A partir de
                </p>

                <p class="price">
                    8,20€
                </p>

                <a class="btn" href="#">voir ce produit</a>
            </article>
        </div>
    </section> -->
</main>

