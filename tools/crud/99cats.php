<?php

require_once "99fields.php";

$SPEC = $CRUD_FIELDS->cats;
$SPEC->assignment_type_lower = 'assignment';
// $SPEC->assignment_type_lower = 'sample exam';
patchSpec($SPEC);

if ( !isset($SPEC_ONLY) ) require_once("99crud.php");
