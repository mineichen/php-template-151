{% extends 'base.html.twig' %}
{% block content %}
    Hallo <span id="greeting-name">{{ name }}</span>
    <a href="https://google.ch" >Mehr Infos auf Google</a>
{% endblock %}

{% block title %}
	{{ parent() }} - Meine tolle Seite
{% endblock %}
