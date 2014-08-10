<?php

abstract class ApiJson extends Controller_Rest {
	// always use JSON as output format
	protected $format = 'json';
}