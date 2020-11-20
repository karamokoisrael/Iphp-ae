<?php
namespace Controller\Localizations;
/**
 *
 */
interface LocalizationMap
{

  /*
  [--------------------------------------------------------------------------
  [ RÉFÉRENCE DE TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ getLocalRef nous retourne un format de référence valide pour
  [	la traduction de nos textes.
  [
  */
  public function getLocalRef(string $ref): string;

  /*
  [--------------------------------------------------------------------------
  [ CATÉGORIE DE TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ getLocalCat nous retourne un nom de fichier de traduction comme
  [ Catégorie à partir d’une référence donnée.
  [
  */
  public function getLocalCat(string $ref): string;

  /*
  [--------------------------------------------------------------------------
  [ DISPONIBILITÉ D'OPTION DE TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ avalabilityOfLocalCat() permet de vérifier la disponibilité
  [ d’une Catégorie de traduction donnée.
  [
  */
  public function avalabilityOfLocalCat(string $refCat, string $index): string;

  /*
  [--------------------------------------------------------------------------
  [ CHANGEMENT DE LA LANGUE
  [--------------------------------------------------------------------------
  [
  [ La méthode settedLocal() ci-dessous retourne la valeur de la
  [ nouvelle langue défini par l’utilisateur
  [ pour le service de traduction.
  [
  */
  public function settedLocal(string $indexKey): ?string;

  /*
  [--------------------------------------------------------------------------
  [ APPLIQUER LA TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ getTrans() retourne une traduction à partir de la clé qu’elle
  [ prend en paramètre depuis, la catégorie courante.
  [
  */
  public function getTrans(string $index, string $ref): string;
}
