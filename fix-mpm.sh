#!/bin/bash
# Désactive mpm_event et active mpm_prefork (plus compatible avec PHP classique)
a2dismod mpm_event
a2enmod mpm_prefork
service apache2 restart