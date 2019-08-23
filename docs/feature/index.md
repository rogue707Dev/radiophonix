title: Feature flags - Radiophonix

# Feature flags

Il y aun système simpliste de feature flags permettant d'activer et de
désactiver des fonctionnalités sur le front.

Ce système va simplement ajouter un `style="display: none;"` à l'élément visé.

## Créer un flag

Les flags se trouvent dans le fichier `resources/assets/js/lib/services/features.js`

Il existe deux configurations : `development` et `production` :

```js
const configs = {
    development: {
        foo: true,
    },

    production: {
        foo: false,
    }
};
```

## Choisir une configuration

Pour activer l'une des configurations, il faut le faire dans le fichier `.env` :

```
FEATURES_CONFIG=development
```

## Utiliser un flag

Pour utiliser un flag sur le front, il suffit d'utiliser la directive `v-feature-on` :

```html
<div v-feature-on="'foo'">
    Ne sera visible que si la feature `foo` est active
</div>
```

!!! info
    Notez qu'il est important de mettre `"'foo'"` et pas `"foo"`
