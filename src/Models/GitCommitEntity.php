<?php
/**
 * Git Commit entity
 *
 * @author Ian <ian@ianh.io>
 * @since 20/03/2019
 */

namespace Icawebdesign\GitInfo\Models;

class GitCommitEntity
{
    /** @var string */
    protected $fullCommitHash;

    /** @var string */
    protected $revision;

    /**
     * @param string $fullCommitHash
     * @return GitCommitEntity
     */
    public function setFullCommitHash(string $fullCommitHash): GitCommitEntity
    {
        $this->fullCommitHash = $fullCommitHash;
        return $this;
    }

    /**
     * @param string $revision
     * @return GitCommitEntity
     */
    public function setRevision(string $revision): GitCommitEntity
    {
        $this->revision = $revision;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullCommitHash(): string
    {
        return $this->fullCommitHash;
    }

    /**
     * @return string
     */
    public function getRevision(): string
    {
        return $this->revision;
    }
}
