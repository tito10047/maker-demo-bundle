<?php

namespace Tito10047\MakerDemoBundle\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

final class PublicAssetsTest extends KernelTestCase
{
    public function testAssetsAreInstalledInThePublicDirectoryOfTheApplication(): void
    {
        $filesystem = new Filesystem();
        $publicDir = sys_get_temp_dir().'/'.uniqid('tito10047-maker-demo-public-');
        $filesystem->mkdir($publicDir);
        $tester = new CommandTester((new Application(self::bootKernel()))->find('assets:install'));

        try {
            $tester->execute(['target' => $publicDir]);

            $tester->assertCommandIsSuccessful();
            $this->assertFileEquals(
                \dirname(__DIR__, 2).'/public/css/tito10047-maker-demo.css',
                $publicDir.'/bundles/tito10047makerdemo/css/tito10047-maker-demo.css',
            );
        } finally {
            $filesystem->remove($publicDir);
        }
    }
}
