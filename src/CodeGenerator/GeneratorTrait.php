<?php

/**
 * @see       https://github.com/laminas/laminas-di for the canonical source repository
 * @copyright https://github.com/laminas/laminas-di/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-di/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Di\CodeGenerator;

use Laminas\Di\Exception\GenerateCodeException;
use Laminas\Di\Exception\LogicException;

/**
 * Trait with generic generator utility methods
 */
trait GeneratorTrait
{
    /**
     * @var int
     */
    protected $mode = 0755;

    /**
     * @var string
     */
    protected $outputDirectory = null;

    /**
     * Ensure that the given directory exists
     *
     * This will check the path at $dir if it exsits and if it is a directory
     *
     * @param string $dir
     * @throws GenerateCodeException
     */
    protected function ensureDirectory(string $dir)
    {
        if (! is_dir($dir) && ! mkdir($dir, $this->mode, true)) {
            throw new GenerateCodeException(sprintf(
                'Could not create output directory: %s',
                $this->outputDirectory
            ));
        }
    }

    /**
     * Ensures the existence of the output directory
     *
     * @throws LogicException
     * @throws GenerateCodeException
     */
    protected function ensureOutputDirectory()
    {
        if (! $this->outputDirectory) {
            throw new LogicException('Cannot generate code without output directory');
        }

        $this->ensureDirectory($this->outputDirectory);
    }

    /**
     * Set the output directory
     *
     * You should configure a psr-4 autoloader with the namespace `Laminas\Di\Generated`
     * to src/ in this directory.
     *
     * The compiler will attempt to create this directory if it does not exist
     *
     * @param string $dir The path to the output directory
     * @param int $mode The creation mode for the directory
     * @return self Provides a fluent interface
     */
    public function setOutputDirectory(string $dir, ?int $mode = null) : self
    {
        $this->outputDirectory = $dir;

        if ($mode !== null) {
            $this->mode = $mode;
        }

        return $this;
    }

    public function getOutputDirectory() : ?string
    {
        return $this->outputDirectory;
    }
}
