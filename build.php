#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$parameterBag = new \Symfony\Component\DependencyInjection\ParameterBag\ParameterBag();
$container = new \Symfony\Component\DependencyInjection\Container($parameterBag);
$builder = new \Symfony\Component\DependencyInjection\ContainerBuilder($parameterBag);

$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass());
$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\ResolveClassPass());
$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\ResolveNamedArgumentsPass());
$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\ReplaceAliasByActualDefinitionPass());
$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\ResolveDefinitionTemplatesPass());
$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\ResolveReferencesToAliasesPass());
$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\ResolveServiceSubscribersPass());
$builder->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\RemoveUnusedDefinitionsPass());


$loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader(
        $builder,
        new \Symfony\Component\Config\FileLocator(__DIR__)
);
$loader->load('config/services.yml');

$builder->compile();
$dumper = new Symfony\Component\DependencyInjection\Dumper\PhpDumper($builder);
file_put_contents('container.php', $dumper->dump(['class' => 'MyContainer']));
