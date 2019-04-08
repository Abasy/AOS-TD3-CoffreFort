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
### Build du projet
### Execution de l'application
Pour lancer les micro-services :