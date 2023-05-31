<style>
.questionsDIV {
  margin: 0 auto; 
  padding: 20px;
  background-color: #f7f7f7;
  border: 2px solid #ccc;
  border-radius: 5px;
  width: 100%; 
  margin-top:100px;
}

.question {
  text-align: center;
  margin-top: 0;
}
</style>

 <?php
 $qas = array(
    array(
        "id" => 1,
        "question" => "J’ai plusieurs ordonnances des médecins différents, que dois-je faire ?",
        "réponse" => "Il n’y a aucun problème, nous ferons un dossier pour chacune des ordonnances. Chaque médecin aura les résultats des analyses qu’il a demandées. Nous ne les facturerons qu’une seule fois. C’est totalement transparent pour vous, tout se passe au secrétariat. Nous ne vous prélèverons qu’une seule fois."
    ),
    array(
        "id" => 2,
        "question" => "Est-ce qu'on peut faire une prise de sang sans ordonnance?",
        "réponse" => "La plupart des analyses médicales peuvent être réalisées sans ordonnance à votre demande. Il vous sera alors demandé de signer un formulaire précisant votre demande. Ces examens ne seront pas pris en charge, ni par l'Assurance Maladie ni par votre mutuelle, et resteront financièrement à votre charge."
    ),
    array(
        "id" => 3,
        "question" => "Puis-je être accompagné et allongé?",
        "réponse" => "Vous pouvez tout-à-fait être accompagné dans la mesure où l’accompagnant ne dérange pas la bonne réalisation du prélèvement. Si besoin, tous les laboratoires du groupe EL_AMEL a des salles de prélèvement avec des fauteuils que l’on peut incliner ou des lits pour vous allonger. Pensez simplement à nous avertir ou à nous le demander."
    ),

    array(
        "id" => 4,
        "question" => "Puis-je venir à n’importe quelle heure ?",
        "réponse" => "Nous vous accueillons généralement sur une large plage horaire du samedi au jeudi et le vendredi matin. Les prises de sang peuvent être réalisées pour la plupart sans contrainte horaire, en respectant les conditions de jeûne éventuelles (en particulier pour la glycémie, le bilan lipidique, …). Les prélèvements en vue de certaines analyses doivent cependant respecter des contraintes d’horaires : certains paramètres varient au cours de la journée. Renseignez-vous auprès de votre laboratoire."
    ),
     array(
     "id" =>5,
     "question" => "Je suis mineur ?",
     "réponse"=>  "Un prélèvement sur un mineur ne peut être effectué sans la présence d’un parent responsable, ou dans le cadre du planning familial, mais toujours accompagné d’un adulte. Les résultats seront transmis au médecin prescripteur ou au responsable légal."
       ),
    array(
    "id" =>6,
     "question" => "Quand il faut être à jeun Peut-on boire de l'eau ?",
     "réponse" => "Etre à jeun signifie ne rien manger, ni boire (sauf de l'eau, toujours autorisée avant une prise de sang) depuis 8H à 12H. Il est conseillé de ne pas fumer pendant cette période."
      ),
    array(
    "id" =>7,
    "question" =>  "Fait-il être à jeun pour prise de sang grossesse ?",
     "réponse" => "Vous pouvez faire cette prise de sang dans n'importe quel laboratoire d'analyses médicales ou à l'hôpital. Il n'est pas nécessaire d'être à jeun, mais certains laboratoires vous demanderont de ne pas manger 2 heures avant l'acte."),
    array(
   "id" => 8,
   "question" =>   "Quelqu’un au laboratoire peut-il m’interpréter les résultats ?   ",
    "réponse" =>  "Bien sûr, les biologistes EL_AMEL sont disponibles pour répondre à l’ensemble de vos questions et interpréter en toute confidentialité vos résultats. Demandez-le à l’accueil !"),
    array(
   "id" => 9,
   "question" =>   "Il m'est d'avoir un bleu après un prélèvement ?",
    "réponse" =>  "Si la veine ne se referme pas assez vite ou si le prélèvement a été difficile, un bleu peut apparaître. Nos préleveurs font tout pour éviter ce genre d’inconvénients. Le bleu vient de l’accumulation de sang entre la paroi de la veine et la peau. Il peut être impressionnant mais n’est jamais grave et disparaît spontanément. Afin de minimiser l’apparition de ces hématomes, il est recommandé d’exercer une pression pendant plusieurs minutes après la prise de sang."),
    array(
   "id" => 10,
    "question" =>  "Que se passe-t-il en cas d'anomalie importante sur un résultat ?",
    "réponse" =>  "Votre médecin prescripteur est systématiquement prévenu en cas d’anomalie importante sur votre résultat. Au cas où il ne serait pas joignable, le laboratoire vous contactera pour vous prévenir et vous donner les directives à suivre : reprendre un RDV avec votre médecin, aller directement aux urgences…")

);
?>

<div id="q" class="questionsDIV">
    <ul class="fa-ul">
<?php foreach ($qas as $qa): ?>
  <li><span class="fa-li"><i class="fa fa-question-circle" aria-hidden="true" style="color:#e21b24;"></i></span>
  <p style="color:#e21b24;" class="question" data-id="<?= $qa['id'] ?>"><?= $qa['question'] ?></p> </li>

  <p class="réponse" data-id="<?= $qa['id'] ?>" style="display:none"><?= $qa['réponse'] ?></p>
<?php endforeach; ?>
 </ul>
</div>


<script>
  const questions = document.querySelectorAll('.question');
  questions.forEach((question) => {
    question.addEventListener('click', () => {
      const id = question.getAttribute('data-id');
      const réponse = document.querySelector(`.réponse[data-id="${id}"]`);
      if (réponse.style.display === 'none') {
        réponse.style.display = 'block';
      } else {
        réponse.style.display = 'none';
      }
    });
  });
</script>
<BR></BR>
<BR></BR>
<BR></BR>
<BR></BR>