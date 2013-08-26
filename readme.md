# HTML Builder
## Include the Builder
``` use Howlowck\HtmlBuilder\Element; ```

## Create Element

```$form = new Element('form');```

## Add/Set Content
You can add a string.
```$form->addContent('welcome!') ```

Or another element
```
$firstName = new Element('input');
$form->addContent($firstName);
```

## Add/Set Attributes
You can set attributes or properties.  The order is the order you add them.

```
$first_name->addAttribute('required');
$first_name->addAttribute(array('id'=>'first_name'));
```

## Get HTML
```
$form->getHtml();
```