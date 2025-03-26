<?php
namespace App;

class PermissionManager
{
    private array $droits;

    public function __construct()
    {
        $this->droits = include __DIR__ . '/droits_avec_libelle.php';
    }

    /**
     * Vérifie si un rôle a accès à une fonctionnalité donnée (ex : 'SFx3')
     */
    public function hasAccess(string $role, string $codeFonctionnalite): bool
    {
        return $this->droits[$codeFonctionnalite][$role] ?? false;
    }

    /**
     * Retourne le libellé (nom clair) d'une fonctionnalité (ex : 'Créer une entreprise')
     */
    public function getLabel(string $codeFonctionnalite): ?string
    {
        return $this->droits[$codeFonctionnalite]['libelle'] ?? null;
    }

    public function getAccessibleFonctionnalites(string $role): array
    {
        $accessible = [];
        foreach ($this->droits as $code => $info) {
            if (!empty($info[$role])) {
                $accessible[$code] = $info['libelle'];
            }
        }
        return $accessible;
    }
}
