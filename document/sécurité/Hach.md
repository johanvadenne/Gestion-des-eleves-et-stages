# Le Haash "auto"

Il sélectionne automatiquement le meilleur hachoir disponible (actuellement Bcrypt). Si PHP ou Symfony ajoute de nouveaux hachages de mots de passe dans le futur, il pourrait sélectionner un hachoir différent.

Pour cette raison, la longueur des mots de passe hachés peut changer dans le futur, donc assurez-vous d'allouer assez d'espace pour qu'ils soient persistants (varchar(255) devrait être un bon réglage).

# Le Bcrypt Password Hasher

Il produit des mots de passe hachés avec la fonction de hachage de mot de passe de bcrypt. Les mots de passe hachés ont une longueur de 60 caractères, assurez-vous donc d'allouer suffisamment d'espace pour qu'ils soient conservés. De plus, les mots de passe contiennent le sel cryptographique (il est généré automatiquement pour chaque nouveau mot de passe), vous n'avez donc pas à vous en préoccuper.

Sa seule option de configuration est le coût, qui est un entier compris entre 4 et 31 (par défaut, 13). Chaque incrément du coût double le temps nécessaire pour hacher un mot de passe. Il est conçu de cette manière afin que la force du mot de passe puisse être adaptée aux améliorations futures de la puissance de calcul.

Vous pouvez modifier le coût à tout moment, même si certains mots de passe ont déjà été hachés à l'aide d'un coût différent. Les nouveaux mots de passe seront hachés en utilisant le nouveau coût, tandis que les mots de passe déjà hachés seront validés en utilisant le coût qui a été utilisé lors de leur hachage.

Traduit avec DeepL.com (version gratuite)

lien wikipédia:
[https://fr.wikipedia.org/wiki/Bcrypt](https://fr.wikipedia.org/wiki/Bcrypt)
[https://symfony.com/doc/current/security/passwords.html#reference-security-encoder-bcrypt](https://symfony.com/doc/current/security/passwords.html#reference-security-encoder-bcrypt)