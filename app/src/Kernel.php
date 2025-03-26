<?php

declare(strict_types=1);

namespace App;

use App\Entity\MyEntity;
use App\Repository\MyRepository;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Attribute\Route;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        yield new FrameworkBundle();
        yield new DoctrineBundle();
    }

    #[Route('/')]
    public function __invoke(MyRepository $repository, EntityManagerInterface $em): JsonResponse
    {
        new SchemaTool($em)->updateSchema([$em->getClassMetadata(MyEntity::class)]);

        $em->persist(new MyEntity(1, 'test'));
        $em->flush();
        $em->clear();

        $entity = $repository->findFirst();

        return new JsonResponse([
            'name' => $entity?->name,
        ])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->extension('doctrine', [
            'dbal' => ['url' => 'sqlite://:memory:'],
            'orm' => [
                'mappings' => [
                    'App' => [
                        'dir' => __DIR__ . '/Entity',
                        'is_bundle' => false,
                        'prefix' => 'App\Entity',
                        'type' => 'attribute',
                    ],
                ],
            ],
        ]);

        $services = $container->services()
            ->defaults()->autowire()->autoconfigure()
        ;
        $services->set(MyRepository::class);
    }
}
