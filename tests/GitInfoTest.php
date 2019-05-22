<?php

namespace Icawebdesign\GitInfo\Tests;

use Icawebdesign\GitInfo\GitInfo;
use Icawebdesign\GitInfo\Models\GitBranchEntity;
use Icawebdesign\GitInfo\Models\GitCommitEntity;
use PHPUnit\Framework\TestCase;
use PhpZip\ZipFile;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class GitInfoTest extends TestCase
{
    /** @var GitInfo */
    protected $gitInfo;

    public function setUp(): void
    {
        parent::setUp();

        $rootPath = __DIR__;
        $zipFile = new ZipFile();

        $zipFile
            ->openFile(sprintf('%s/.git.zip', $rootPath))
            ->extractTo($rootPath);

        $zipFile->close();

        $this->gitInfo = new GitInfo($rootPath, new GitBranchEntity(), new GitCommitEntity());
    }

    public function tearDown(): void
    {
        $this->recursiveDeletePath(sprintf('%s/.git', __DIR__));
        $this->gitInfo = null;
    }

    protected function recursiveDeletePath(string $path)
    {
        $iterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
        $items = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($items as $item) {
            if ($item->isDir()) {
                rmdir($item->getRealPath());
            } else {
                unlink($item->getRealPath());
            }
        }

        rmdir($path);
    }

    /** @test */
    public function getting_branch_info_returns_the_a_git_branch_entity(): void
    {
        $branch = $this->gitInfo->branchInfo();
        $this->assertSame('master', $branch->getBranch());
        $this->assertInstanceOf(GitBranchEntity::class, $branch);
    }

    /** @test */
    public function getting_commit_info_returns_a_git_commit_entity(): void
    {
        $commit = $this->gitInfo->commitInfo();
        $this->assertSame('a343447bc020e6bb7406b9faf22fd16bb2624072', $commit->getFullCommitHash());
        $this->assertSame('a343447', $commit->getRevision());
        $this->assertInstanceOf(GitCommitEntity::class, $commit);
    }
}
