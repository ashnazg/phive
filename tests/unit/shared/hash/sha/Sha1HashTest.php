<?php
namespace PharIo\Phive;

use PHPUnit\Framework\TestCase;

/**
 * @covers \PharIo\Phive\Sha1Hash
 * @covers \PharIo\Phive\BaseHash
 */
class Sha1HashTest extends TestCase {

    public static function invalidHashProvider() {
        return [
            ['foo'],
            [123],
            ['7a8755061d7ac2bc09f25bf6a867031fb945b4b25a6be1fb41b117893065f76c']
        ];
    }

    public static function validHashProvider() {
        return [
            ['aa43f08c9402ca142f607fa2db0b1152cf248d49'],
            ['174f7e679a514cf52fd63c96659b10d470e65ec0']
        ];
    }

    /**
     * @dataProvider invalidHashProvider
     *
     * @expectedException \PharIo\Phive\InvalidHashException
     *
     * @param mixed $hashValue
     */
    public function testThrowsExceptionIfValueIsNotAValidSha1Hash($hashValue) {
        new Sha1Hash($hashValue);
    }

    /**
     * @dataProvider validHashProvider
     *
     * @param string $hashValue
     */
    public function testAsStringReturnsExpectedValue($hashValue) {
        $hash = new Sha1Hash($hashValue);
        $this->assertSame($hashValue, $hash->asString());
    }

    public function testEquals() {
        $hash = new Sha1Hash('aa43f08c9402ca142f607fa2db0b1152cf248d49');
        $otherHash = new Sha1Hash('aa43f08c9402ca142f607fa2db0b1152cf248d49');
        $this->assertTrue($hash->equals($otherHash));

        $hash = new Sha1Hash('174f7e679a514cf52fd63c96659b10d470e65ec0');
        $otherHash = new Sha1Hash('aa43f08c9402ca142f607fa2db0b1152cf248d49');
        $this->assertFalse($hash->equals($otherHash));
    }

    public function testForContentCreatesExpectedHash() {
        $expected = new Sha1Hash('0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33');
        $actual = Sha1Hash::forContent('foo');

        $this->assertEquals($expected, $actual);
    }
}



