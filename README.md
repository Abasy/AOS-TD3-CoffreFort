# AOS-TD3-CoffreFort
Un client demande de protéger une ressource très importante. Il faut que seuls les utilisateurs autorisées aient accès à cette ressource.

## Architecture de l'application
	* Frontend : permet d’avoir un accès graphique aux services pour
	les utilisateurs n’ayant aucune compétence technique.

	* APIUser : contient la base de donnée utilisateur.

	* TokenDealer : permet de transmettre des jetons JWT permettant aux utilisateurs de s’authentifier.
	La communication est asynchrone entre les autres services et le TokenDealer.

	* APIApr (Accès Ressource Protégée) : demande au TokenDealer d’authentifier un jeton avant de transmettre la ressource à un utilisateur.
## Build et exécution (en standalone)
### Build du projet
Pas de build en standalone.

### Execution de l'application
Pour lancer le frontend :
	*

Pour lancer les micro-services :
	* APIUser

		python flsk2.py

	* TokenDealer

		python TokenDealer.py

	* APIApr

		python api_accees_ressources_proteger.py

## Build et exécution (avec Docker)
### Build du projet
### Execution de l'application
Pour lancer les micro-services :