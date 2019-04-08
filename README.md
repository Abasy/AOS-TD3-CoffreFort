# AOS-TD3-CoffreFort
Un client demande de protéger une ressource très importante. Il faut que seuls les utilisateurs autorisées aient accès à cette ressource.

## Architecture de l'application
	* Frontend : permet d’avoir un accès graphique aux services pour
	les utilisateurs n’ayant aucune compétence technique.
		*`index` page php : affiche la ressouce si un utilisateur est authentifié. Sur l'index on peut
		se connecter ou s'inscrire. Si un utilisateur est authentifié, il peut accédé à son compte ou
		se déconnecter.
		*`register` page php : permet à un utilisateur de créer un compte.
		*`signin` page php : permet à un utilisateur de se connecter
		*`signout` page php : permet à un utilisateur de se déconnecter
		*`accountUser` page php : permet à un utilisateur de modifier son compte ou de le supprimer.

	* APIUser : contient la base de donnée utilisateur.

	* TokenDealer : permet de transmettre des jetons JWT permettant aux utilisateurs de s’authentifier.
	La communication est asynchrone entre les autres services et le TokenDealer.

	* APIApr (Accès Ressource Protégée) : demande au TokenDealer d’authentifier un jeton avant de transmettre la ressource à un utilisateur.

## Build et exécution (en standalone)
### Build du projet
Pas de build en standalone.

### Execution de l'application
Pour lancer le frontend :
	* Avec un windows : lancer le serveur wamp
	* Avec un mac : lancer le serveur mamp
	* Avec un linux : lancer le server lamp

Une fois le serveur lancé, on accéde au lien :
	
	http://localhost/AOS-TD3-CoffreFort/PageWeb/index.php

Pour lancer les micro-services :
	* APIUser
        
        Pour lancer le service il suffit de tapper la commande suivante
        `python userapi.py`
        
        Ce service permet de gérer les utilisateurs : Ajouter, Modifier et supprimer un utilisateur 
        Il permet aussi de se connecter et se déconnecter du systéme.
        
        Pour ajouter un utilisateur il faut exploiter le lien suivant :
            * `http://localhost:4321/api/add`
        
        Pour modifier un utilisateur
            * `http://localhost:4321/api/update`
        
        Pour Supprimer un utilisateur 
            * `http://localhost:4321/api/delete`
        
        Pour se connecter :
            * `http://localhost:4321/api/auth`
        
        pour se déconnecter :
            * `http://localhost:4321/api/logout`
        
        Pour avoir un utilisateur à partir de son username et password :
            * `http://localhost:4321/api/getUser`
        
        Le service communique avec le token dealer pour avoir un token valide, ainsi que pour invalider un token.
             
		

	* TokenDealer

		python tokendealer.py

	* ApiApr

		python apiapr.py

## Build et exécution (avec Docker)
Pour deployer les différents services sur le docker il faut lancer la commande suivante dans chaque service :

	`docker build .`
	
Vous pouvez vérifier que chaque service se lance correctement en tapant la commande suivante :

	`docker run <nom de build de service voulu>`
	
Et créer un réseau docker pour zmq afin d'établir la connexion entre les token dealer et les services qui l'interrogent avec la commande suivante :

	`docker network create zmq`
	
Tapez cette commande pour lancer le token dealer en précisant le nom de domaine qui sera même que celui du code

`docker run -it --network=zmq --net-alias=domaine_name <nom de build service>`

Pour cette partie on a pas pu faire fonctionner le tous sur Docker à cause de server Apache qu'on utilise dans le côte Front end.



	
### Build du projet
### Execution de l'application
Pour lancer les micro-services :
- TokenDealer : 
	Pour lancer le service tapez cette commande : `TokenDealer.py <NUMERO_PORT>`
	Pour demander la génération d'un token ,on envoie sur la socket de ZMQ la requête suivante : `bdd login <PASSWORD>`
	Pour rendre un token invalid (le cas d'une requête de connexion côté client) : `bdd logout <TOKEN>`
	Pour verifier si un token est valide ou non : `arp <TOKEN>`

